# CSS Architecture - Modular Structure

## 📁 Directory Structure

```
css/
├── critical.css              # Inlined in <head> for first paint
├── base.css                  # Reset, typography, forms, entry content
├── layout.css                # Grid, containers, columns
├── utilities.css             # Helper classes, icons, plugins
├── theme.css                 # Custom theme modifications
└── components/
    ├── navigation.css        # Nav menus, search
    ├── header.css            # Site header
    ├── footer.css            # Footer sections
    ├── posts.css             # Post entry, formats, meta
    ├── sidebar.css           # Sidebar & toggle
    ├── widgets.css           # Widget styles
    └── comments.css          # Comments (conditionally loaded)
```

## ⚡ Loading Strategy

### Critical CSS (Inlined)

- ~8KB inlined in `<head>` for immediate rendering
- Above-fold styles only
- Font-face declarations
- Container/header/basic post structure

### Base Styles (Render-blocking)

- Essential layout and typography
- Loaded in order: base → layout → utilities

### Component Styles (Render-blocking)

- Modular files for each major component
- Better browser caching
- Easier to maintain

### Conditional Loading

- **Comments CSS** only loads on single posts/pages with comments
- Reduces ~4KB for non-comment pages

## 🎯 Performance Benefits

1. **Faster Initial Render**: Critical CSS inlined (~8KB)
2. **Better Caching**: Modular files cached independently
3. **Reduced File Size**: Conditional loading saves bandwidth
4. **Easier Maintenance**: Each component isolated
5. **Parallel Downloads**: Browser can fetch multiple small files

## 🔧 File Sizes

- critical.css: ~8KB (inlined)
- base.css: ~20KB
- layout.css: ~12KB
- components/: ~6-8KB each
- utilities.css: ~8KB
- theme.css: ~3KB

**Total**: ~80KB (vs 100KB+ monolithic)
**Typical Page Load**: ~50KB (with conditional loading)

## 📝 Maintenance Notes

- Update version in `functions.php` when making CSS changes
- Critical CSS should only contain above-fold styles
- Keep `style.css` as fallback (WordPress requirement)
- Test conditional loading on different page types
