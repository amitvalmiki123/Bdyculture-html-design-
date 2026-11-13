package com.personal.ioslauncher

import android.app.Activity
import android.app.Dialog
import android.content.Intent
import android.content.pm.PackageManager
import android.graphics.Canvas
import android.graphics.Paint
import android.graphics.RadialGradient
import android.graphics.Shader
import android.graphics.drawable.GradientDrawable
import android.os.Bundle
import android.os.Handler
import android.os.Looper
import android.text.Editable
import android.text.TextWatcher
import android.view.Gravity
import android.view.View
import android.view.WindowManager
import android.widget.EditText
import android.widget.FrameLayout
import android.widget.GridLayout
import android.widget.HorizontalScrollView
import android.widget.ImageView
import android.widget.LinearLayout
import android.widget.ScrollView
import android.widget.TextView
import android.text.format.DateFormat
import java.text.SimpleDateFormat
import java.util.Date
import java.util.Locale

class MainActivity : Activity() {
    private val pageSize = 16
    private val columns = 4
    private lateinit var root: FrameLayout
    private lateinit var pages: LinearLayout
    private lateinit var pager: HorizontalScrollView
    private lateinit var dots: LinearLayout
    private lateinit var apps: List<AppEntry>
    private val white = 0xFFFFFFFF.toInt()
    private var pageWidth = 0
    private lateinit var clockText: TextView
    private val clockHandler = Handler(Looper.getMainLooper())
    private val clockTicker = object : Runnable {
        override fun run() {
            if (::clockText.isInitialized) clockText.text = DateFormat.getTimeFormat(this@MainActivity).format(Date())
            clockHandler.postDelayed(this, 30_000L)
        }
    }

    override fun onResume() {
        super.onResume()
        clockHandler.removeCallbacks(clockTicker)
        clockTicker.run()
    }

    override fun onPause() {
        clockHandler.removeCallbacks(clockTicker)
        super.onPause()
    }

    data class AppEntry(val label: String, val packageName: String, val icon: android.graphics.drawable.Drawable)

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        window.statusBarColor = android.graphics.Color.TRANSPARENT
        window.navigationBarColor = android.graphics.Color.TRANSPARENT
        window.decorView.systemUiVisibility = (View.SYSTEM_UI_FLAG_LAYOUT_STABLE
                or View.SYSTEM_UI_FLAG_LAYOUT_FULLSCREEN
                or View.SYSTEM_UI_FLAG_LAYOUT_HIDE_NAVIGATION)
        window.addFlags(WindowManager.LayoutParams.FLAG_DRAWS_SYSTEM_BAR_BACKGROUNDS)
        apps = loadApps()
        buildHome()
    }

    private fun loadApps(): List<AppEntry> {
        val pm = packageManager
        val launcher = Intent(Intent.ACTION_MAIN).addCategory(Intent.CATEGORY_LAUNCHER)
        return pm.queryIntentActivities(launcher, PackageManager.MATCH_ALL)
            .mapNotNull { info ->
                val activity = info.activityInfo ?: return@mapNotNull null
                if (activity.packageName == packageName) return@mapNotNull null
                AppEntry(info.loadLabel(pm).toString(), activity.packageName, info.loadIcon(pm))
            }
            .distinctBy { it.packageName }
            .sortedBy { it.label.lowercase(Locale.getDefault()) }
    }

    private fun buildHome() {
        root = object : FrameLayout(this) {
            private var downY = 0f
            override fun dispatchTouchEvent(event: android.view.MotionEvent): Boolean {
                if (event.action == android.view.MotionEvent.ACTION_DOWN) downY = event.y
                val handled = super.dispatchTouchEvent(event)
                if (event.action == android.view.MotionEvent.ACTION_UP && downY - event.y > dp(90)) openDrawer()
                return handled
            }
        }
        root.addView(WallpaperView(), FrameLayout.LayoutParams(-1, -1))
        val content = LinearLayout(this).apply {
            orientation = LinearLayout.VERTICAL
            setPadding(dp(18), dp(38), dp(18), dp(22))
        }
        root.addView(content, FrameLayout.LayoutParams(-1, -1))

        val header = LinearLayout(this).apply {
            orientation = LinearLayout.VERTICAL
            gravity = Gravity.CENTER
            background = glass(34)
            elevation = dp(8).toFloat()
            setPadding(dp(18), dp(13), dp(18), dp(13))
        }
        val date = TextView(this).apply {
            text = SimpleDateFormat("EEEE, d MMMM", Locale.getDefault()).format(Date())
            setTextColor(0xEFFFFFFF.toInt())
            textSize = 15f
            letterSpacing = 0.035f
            gravity = Gravity.CENTER
            setShadowLayer(8f, 0f, dp(2).toFloat(), 0x66000000)
        }
        clockText = TextView(this).apply {
            text = DateFormat.getTimeFormat(this@MainActivity).format(Date())
            setTextColor(white)
            textSize = 76f
            letterSpacing = -0.055f
            setTypeface(android.graphics.Typeface.create("sans-serif-thin", android.graphics.Typeface.NORMAL))
            gravity = Gravity.CENTER
            includeFontPadding = false
            setShadowLayer(16f, 0f, dp(4).toFloat(), 0x55000000)
        }
        val focusChip = TextView(this).apply {
            text = "✦   PERSONAL FOCUS"
            setTextColor(0xEFFFFFFF.toInt())
            textSize = 10f
            letterSpacing = 0.11f
            gravity = Gravity.CENTER
            background = glass(50, 0x22FFFFFF)
            setPadding(dp(14), dp(7), dp(14), dp(7))
        }
        header.addView(date)
        header.addView(clockText, LinearLayout.LayoutParams(-1, dp(94)))
        header.addView(focusChip, LinearLayout.LayoutParams(-2, dp(30)).apply { topMargin = dp(3) })
        content.addView(header, LinearLayout.LayoutParams(-1, dp(194)))

        pager = HorizontalScrollView(this).apply {
            isHorizontalScrollBarEnabled = false
            overScrollMode = View.OVER_SCROLL_NEVER
            isFillViewport = true
        }
        pages = LinearLayout(this).apply { orientation = LinearLayout.HORIZONTAL }
        pager.addView(pages, HorizontalScrollView.LayoutParams(-2, -1))
        content.addView(pager, LinearLayout.LayoutParams(-1, 0, 1f).apply {
            topMargin = dp(8)
            bottomMargin = dp(1)
        })

        dots = LinearLayout(this).apply {
            gravity = Gravity.CENTER
            orientation = LinearLayout.HORIZONTAL
            setOnClickListener { openDrawer() }
        }
        content.addView(dots, LinearLayout.LayoutParams(-1, dp(24)))

        val dock = LinearLayout(this).apply {
            orientation = LinearLayout.HORIZONTAL
            gravity = Gravity.CENTER
            background = glass(30, 0x38FFFFFF)
            elevation = dp(8).toFloat()
            setPadding(dp(8), dp(8), dp(8), dp(8))
        }
        val dockApps = chooseDockApps()
        dockApps.forEach { entry -> dock.addView(appTile(entry, true), LinearLayout.LayoutParams(0, -1, 1f)) }
        content.addView(dock, LinearLayout.LayoutParams(-1, dp(82)).apply {
            topMargin = dp(2)
        })

        val hint = TextView(this).apply {
            text = "Swipe up to search your apps"
            textSize = 12f
            setTextColor(0xCFFFFFFF.toInt())
            gravity = Gravity.CENTER
            setOnClickListener { openDrawer() }
        }
        content.addView(hint, LinearLayout.LayoutParams(-1, dp(25)))
        setContentView(root)
        pager.setOnScrollChangeListener { _, scrollX, _, _, _ ->
            if (pageWidth > 0) {
                val selected = (scrollX + pageWidth / 2) / pageWidth
                for (i in 0 until dots.childCount) {
                    val item = dots.getChildAt(i)
                    item.layoutParams = item.layoutParams.apply { width = dp(if (i == selected) 17 else 6) }
                    item.background = rounded(if (i == selected) white else 0x75FFFFFF, 50)
                }
            }
        }
        pager.post { rebuildPages() }
        root.setOnApplyWindowInsetsListener { _, insets ->
            // Keep the iOS-style content clear of the Android gesture/navigation area.
            insets
        }
    }

    private fun rebuildPages() {
        val width = pager.width
        if (width <= 0) return
        pageWidth = width
        pages.removeAllViews()
        val pageCount = maxOf(1, (apps.size + pageSize - 1) / pageSize)
        repeat(pageCount) { page ->
            val grid = LinearLayout(this).apply {
                orientation = LinearLayout.VERTICAL
                setPadding(0, dp(8), 0, dp(2))
            }
            for (row in 0 until 4) {
                val rowLayout = LinearLayout(this).apply {
                    orientation = LinearLayout.HORIZONTAL
                    gravity = Gravity.CENTER
                }
                for (col in 0 until columns) {
                    val index = page * pageSize + row * columns + col
                    val tile = if (index < apps.size) appTile(apps[index], false) else View(this)
                    rowLayout.addView(tile, LinearLayout.LayoutParams(0, -1, 1f))
                }
                grid.addView(rowLayout, LinearLayout.LayoutParams(-1, 0, 1f))
            }
            pages.addView(grid, LinearLayout.LayoutParams(width, -1))
        }
        dots.removeAllViews()
        repeat(pageCount) { index ->
            val dot = View(this).apply {
                background = rounded(if (index == 0) white else 0x75FFFFFF, 50)
                setOnClickListener { pager.smoothScrollTo(index * pageWidth, 0) }
            }
            dots.addView(dot, LinearLayout.LayoutParams(dp(if (index == 0) 17 else 6), dp(6)).apply {
                marginStart = dp(3); marginEnd = dp(3)
            })
        }
    }

    private fun chooseDockApps(): List<AppEntry> {
        val preferred = listOf("phone", "message", "chrome", "camera", "dialer", "contacts", "browser")
        val selected = preferred.mapNotNull { key -> apps.firstOrNull { it.label.contains(key, true) } }
            .distinctBy { it.packageName }.take(4).toMutableList()
        apps.filterNot { entry -> selected.any { it.packageName == entry.packageName } }
            .take(4 - selected.size).forEach(selected::add)
        return selected
    }

    private fun appTile(entry: AppEntry, dockTile: Boolean): View {
        val tile = LinearLayout(this).apply {
            orientation = LinearLayout.VERTICAL
            gravity = Gravity.CENTER
            isClickable = true
            isFocusable = true
            setOnClickListener { launch(entry.packageName) }
            setOnLongClickListener {
                openAppInfo(entry.packageName)
                true
            }
        }
        val icon = ImageView(this).apply {
            setImageDrawable(entry.icon)
            scaleType = ImageView.ScaleType.FIT_CENTER
            clipToOutline = true
            background = rounded(0x18FFFFFF, 22)
        }
        val iconSize = if (dockTile) 52 else 53
        tile.addView(icon, LinearLayout.LayoutParams(dp(iconSize), dp(iconSize)))
        if (!dockTile) {
            val label = TextView(this).apply {
                text = entry.label
                textSize = 11f
                setTextColor(white)
                gravity = Gravity.CENTER
                maxLines = 1
                ellipsize = android.text.TextUtils.TruncateAt.END
                setShadowLayer(3f, 0f, 1f, 0x99000000.toInt())
            }
            tile.addView(label, LinearLayout.LayoutParams(-1, dp(22)).apply { topMargin = dp(3) })
        }
        return tile
    }

    private fun openDrawer() {
        val dialog = Dialog(this)
        val shell = FrameLayout(this).apply {
            background = glass(32, 0xF0223554.toInt())
            setPadding(dp(20), dp(18), dp(20), dp(12))
        }
        val layout = LinearLayout(this).apply { orientation = LinearLayout.VERTICAL }
        shell.addView(layout, FrameLayout.LayoutParams(-1, -1))
        val heading = TextView(this).apply {
            text = "App Library"
            textSize = 25f
            setTextColor(white)
            setTypeface(typeface, android.graphics.Typeface.BOLD)
        }
        layout.addView(heading, LinearLayout.LayoutParams(-1, dp(38)))
        val search = EditText(this).apply {
            hint = "Search apps"
            setHintTextColor(0xBFFFFFFF.toInt())
            setTextColor(white)
            textSize = 16f
            singleLine = true
            background = glass(18, 0x2EFFFFFF)
            setPadding(dp(16), 0, dp(16), 0)
        }
        layout.addView(search, LinearLayout.LayoutParams(-1, dp(48)).apply { topMargin = dp(4); bottomMargin = dp(12) })
        val scroll = ScrollView(this).apply { isFillViewport = true }
        val grid = GridLayout(this).apply { columnCount = columns; useDefaultMargins = false }
        scroll.addView(grid, ScrollView.LayoutParams(-1, -2))
        layout.addView(scroll, LinearLayout.LayoutParams(-1, 0, 1f))
        fun fill(query: String) {
            grid.removeAllViews()
            val filtered = apps.filter { it.label.contains(query, true) }
            filtered.forEach { entry ->
                val tile = appTile(entry, false)
                grid.addView(tile, GridLayout.LayoutParams().apply {
                    width = 0; height = dp(92); columnSpec = GridLayout.spec(GridLayout.UNDEFINED, 1f)
                })
            }
        }
        fill("")
        search.addTextChangedListener(object : TextWatcher {
            override fun beforeTextChanged(s: CharSequence?, start: Int, count: Int, after: Int) = Unit
            override fun onTextChanged(s: CharSequence?, start: Int, before: Int, count: Int) = fill(s?.toString().orEmpty())
            override fun afterTextChanged(s: Editable?) = Unit
        })
        dialog.setContentView(shell)
        dialog.window?.apply {
            setBackgroundDrawableResource(android.R.color.transparent)
            setLayout(WindowManager.LayoutParams.MATCH_PARENT, WindowManager.LayoutParams.MATCH_PARENT)
            addFlags(WindowManager.LayoutParams.FLAG_DIM_BEHIND)
            attributes = attributes.apply { dimAmount = 0.24f }
        }
        dialog.show()
        dialog.window?.setLayout(WindowManager.LayoutParams.MATCH_PARENT, WindowManager.LayoutParams.MATCH_PARENT)
        search.requestFocus()
    }

    private fun launch(packageName: String) {
        packageManager.getLaunchIntentForPackage(packageName)?.let { startActivity(it) }
    }

    private fun openAppInfo(packageName: String) {
        runCatching {
            startActivity(Intent(android.provider.Settings.ACTION_APPLICATION_DETAILS_SETTINGS).apply {
                data = android.net.Uri.parse("package:$packageName")
            })
        }
    }

    private fun rounded(color: Int, radiusDp: Int) = GradientDrawable().apply {
        setColor(color)
        cornerRadius = dp(radiusDp).toFloat()
    }

    private fun glass(radiusDp: Int, tint: Int = 0x38FFFFFF): GradientDrawable = GradientDrawable(
        GradientDrawable.Orientation.TOP_BOTTOM,
        intArrayOf(tint, 0x18FFFFFF)
    ).apply {
        cornerRadius = dp(radiusDp).toFloat()
        setStroke(dp(1), 0x66FFFFFF)
    }

    private fun dp(value: Int) = (value * resources.displayMetrics.density).toInt()

    private inner class WallpaperView : View(this@MainActivity) {
        private val paint = Paint(Paint.ANTI_ALIAS_FLAG)
        override fun onDraw(canvas: Canvas) {
            super.onDraw(canvas)
            val w = width.toFloat(); val h = height.toFloat()
            paint.shader = android.graphics.LinearGradient(0f, 0f, w * .2f, h,
                intArrayOf(0xFF284F91.toInt(), 0xFF516AB5.toInt(), 0xFFB17CB7.toInt(), 0xFFEF9F91.toInt()),
                floatArrayOf(0f, .38f, .74f, 1f), Shader.TileMode.CLAMP)
            canvas.drawRect(0f, 0f, w, h, paint)
            paint.shader = RadialGradient(w * .16f, h * .36f, w * .75f,
                intArrayOf(0x667FD8FF, 0x0058C3E8), null, Shader.TileMode.CLAMP)
            canvas.drawCircle(w * .16f, h * .36f, w * .75f, paint)
            paint.shader = RadialGradient(w * .88f, h * .78f, w * .7f,
                intArrayOf(0x66FFC990, 0x00F782A4), null, Shader.TileMode.CLAMP)
            canvas.drawCircle(w * .88f, h * .78f, w * .7f, paint)
            paint.shader = null
        }
    }
}
