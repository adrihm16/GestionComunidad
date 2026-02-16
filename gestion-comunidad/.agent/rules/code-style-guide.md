---
trigger: always_on
---

PROJECT RULES: COMMUNITY MANAGER APP (ANTIGRAVITY)
1. Design Philosophy & Vibe
Style: Modern Eco-Tech, Clean, Mobile-First.

Font Family: Poppins (Google Fonts) for ALL text.

Weights: Use SemiBold (600) for Headers/Titles. Use Regular (400) or Medium (500) for body text.

Radius: Soft and friendly. Consistent usage of rounded-xl (approx 12px-16px).

2. Color Palette (Tailwind CSS Map)
Based on the provided mockup and neon preferences.

Backgrounds:

bg-page: #F5F7FA (Gris muy claro, casi blanco, extraído del fondo de la imagen).

bg-card: #FFFFFF (Blanco puro para el contenido).

Primary (The "Forest" Green - From Image Header):

bg-primary: #1E4A26 (Un verde bosque oscuro y elegante).

Use this for: Card headers, Primary Buttons, Navbar elements.

Accents (The "Neon" Greens - For Interactions):

text-accent: #26FF05 (Verde neón vibrante).

border-accent: #A3FF05 (Verde lima).

Use these for: Active states, Notification dots, Hover effects, or small icons inside dark buttons.

Text:

text-main: #1A1A1A (Negro suave).

text-muted: #6B7280 (Gris para fechas o subtítulos).

3. UI Component Rules (Strict Adherence to Mockup)
A. The "Dual-Tone" Card
The cards must strictly follow the design in the image:

Structure: A container with a colored top header strip and a white body.

Shape: rounded-xl or rounded-2xl.

Shadow: shadow-md (Soft vertical drop shadow).

Header Strip:

Height: Approx h-4 or h-5 (16px - 20px).

Color: bg-primary (#1E4A26).

Crucial: The header strip must have rounded TOP corners, but flat BOTTOM corners. The white body has flat TOP corners and rounded BOTTOM corners.

Code Implementation Example (Tailwind):

JavaScript

<div className="flex flex-col rounded-2xl shadow-lg overflow-hidden bg-white w-full">
  {/* The Dark Green Strip */}
  <div className="h-4 bg-[#1E4A26] w-full"></div>
  {/* Content */}
  <div className="p-4">
    {children}
  </div>
</div>
B. Typography & Spacing
Section Titles:

font-poppins font-semibold text-lg text-black mb-2.

Example: "Últimas noticias", "Próxima reunión".

Alignment: Left aligned, strictly above the card.

Margins:

Page Layout: px-5 (20px horizontal padding) for mobile views to match the mockup's whitespace.

Vertical Spacing: gap-6 between sections.

C. Header & Navigation
Top Bar:

Layout: Flexbox justify-between.

User Avatar: Circle icon with stroke. Text "Usuario" in font-medium.

Icons (Menu/Bell): High contrast black stroke.

Iconography Style:

Type: Outline / Stroke-based (not filled).

Stroke Width: 2px (Thick and legible).

Color: #000000 for general UI, #FFFFFF if inside a green button.

Library Recommendation: Lucide React or Heroicons (Outline).

D. Bottom Action Buttons (From Image Footer)
Three square-ish floating buttons or fixed footer elements.

Shape: rounded-xl (Rounded squares).

Color: bg-primary (#1E4A26).

Shadow: shadow-lg.

4. Technical Constraints for AI Generation
Framework: React / Next.js.

Styling: Tailwind CSS.

Font: Import Poppins via next/font or Google Fonts CDN.

Responsive: Mobile-First approach (design strictly for mobile view first as shown in image).