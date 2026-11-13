# iOS Style Launcher (Android)

A personal-use Android HOME launcher with an iPhone-inspired home screen: a soft gradient wallpaper, app grid, translucent dock, swipeable pages, and a searchable App Library. It uses installed Android app icons and opens the selected app; long-press an icon to open its Android app settings.

## Build

Requires JDK 17 and Android SDK Platform 35 / Build Tools (Gradle wrapper downloads Gradle 8.9):

```sh
./gradlew assembleDebug
```

The installable debug APK is written to `app/build/outputs/apk/debug/app-debug.apk`. A GitHub Actions build is configured for pushes to this working branch and uploads the APK as a workflow artifact.

## Install and select as Home

Install the debug APK, then press the device Home button and choose **iOS Style Launcher**. Android may offer a system settings screen for the default Home app. To switch back, choose another Home app in Android Settings.

This is an independent personal launcher project and is not associated with the clinic website in the parent repository. It is an early, source-first build; app drawer search and basic home navigation are included, while wallpaper selection, icon rearranging/folders, widgets, and notification badges are not yet implemented.
