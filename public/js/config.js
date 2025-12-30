/**
 * Divine Light School - Configuration File
 * Easy customization of school information
 */

const schoolConfig = {
    // School Information
    school: {
        name: "Divine Light International School & Seminary",
        shortName: "Divine Light School",
        tagline: "Excellence in Education, Excellence in Character",
        mission: "Divine Light International School & Divine Light Seminary Secondary School is dedicated to providing quality education that nurtures academic excellence, character development, and holistic growth. We blend classical educational values with modern teaching methodologies to create an environment where students thrive.",
        vision: "To be a beacon of educational excellence, producing well-rounded individuals equipped with knowledge, skills, and moral values to positively impact their communities and the world."
    },

    // Contact Information
    contact: {
        address: {
            line1: "@6-9 CFG Avenue",
            line2: "off 119 P.H Road",
            city: "Aba",
            state: "Abia State",
            country: "Nigeria"
        },
        phone: [
            "+234 (0) XXX XXX XXXX",
            "+234 (0) XXX XXX XXXX"
        ],
        email: {
            info: "info@divinelightschool.ng",
            admissions: "admissions@divinelightschool.ng"
        },
        hours: {
            weekday: "7:30 AM - 4:00 PM",
            weekend: "Closed"
        }
    },

    // Social Media
    social: {
        facebook: "#",
        instagram: "#",
        twitter: "#",
        whatsapp: "#"
    },

    // Statistics
    stats: {
        students: 500,
        staff: 30,
        programs: 4,
        years: 10
    },

    // Programs
    programs: [
        {
            id: 1,
            name: "Early Childhood",
            icon: "fa-apple-alt",
            description: "Foundation for lifelong learning. We focus on developing social skills, creativity, and foundational academic knowledge in a nurturing environment.",
            features: ["Play-based Learning", "Language Development", "Creative Arts"]
        },
        {
            id: 2,
            name: "Primary Education",
            icon: "fa-book-open",
            description: "Building strong academic foundations with emphasis on critical thinking, problem-solving, and character development.",
            features: ["Core Academics", "STEM Subjects", "Physical Education"]
        },
        {
            id: 3,
            name: "Secondary Education",
            icon: "fa-graduation-cap",
            description: "Advanced curriculum preparing students for higher education and future careers with specialized subject streams.",
            features: ["Advanced Sciences", "Humanities", "Leadership Training"]
        },
        {
            id: 4,
            name: "Seminary Program",
            icon: "fa-monastery",
            description: "Specialized education combining academic excellence with spiritual growth and values-based learning.",
            features: ["Theological Studies", "Moral Formation", "Community Service"]
        }
    ],

    // Features/Why Us
    features: [
        {
            icon: "fa-chalkboard-user",
            title: "Expert Faculty",
            description: "Highly qualified and dedicated teachers committed to student success and personal development."
        },
        {
            icon: "fa-laptop",
            title: "Modern Facilities",
            description: "State-of-the-art classrooms, laboratories, and technology-enabled learning spaces."
        },
        {
            icon: "fa-shield",
            title: "Safe Environment",
            description: "Secure, comfortable campus with comprehensive safety protocols and student welfare measures."
        },
        {
            icon: "fa-users",
            title: "Holistic Development",
            description: "Co-curricular activities fostering sports, arts, leadership, and character development."
        },
        {
            icon: "fa-handshake",
            title: "Parent Partnership",
            description: "Strong collaboration with parents ensuring consistent support for student growth."
        },
        {
            icon: "fa-globe",
            title: "Global Perspective",
            description: "International curriculum standards combined with local cultural values and relevance."
        }
    ],

    // Upcoming Events
    events: [
        {
            id: 1,
            date: "2025-12-08",
            month: "Dec",
            day: 8,
            title: "2025 Trade Fair & Exhibition",
            description: "Come and shop at very cheap prices while watching the talent and creativity of Divine Light kids.",
            time: "8:00 AM",
            location: "@6-9 CFG Avenue off 119 P.H Road Aba"
        },
        {
            id: 2,
            date: "2025-12-15",
            month: "Dec",
            day: 15,
            title: "Year-End Celebration",
            description: "Join us for a spectacular year-end celebration featuring student performances, awards presentation, and special surprises.",
            time: "9:00 AM",
            location: "School Auditorium"
        },
        {
            id: 3,
            date: "2026-01-10",
            month: "Jan",
            day: 10,
            title: "New Academic Session Begins",
            description: "Welcome back! New and returning students gather for orientation and the commencement of the new academic year.",
            time: "7:30 AM",
            location: "School Campus"
        }
    ],

    // Testimonials
    testimonials: [
        {
            quote: "Divine Light has been exceptional in nurturing both the academic and moral development of our child. The teachers are dedicated and genuinely care about each student's growth.",
            author: "Mrs. Adeola Johnson",
            role: "Parent, Grade 4",
            rating: 5
        },
        {
            quote: "The environment here is safe, friendly, and encouraging. I love my school! The teachers make learning fun and we're encouraged to participate in many activities.",
            author: "Chisom",
            role: "Student, Grade 6",
            rating: 5
        },
        {
            quote: "The quality of education combined with values-based teaching is exactly what we were looking for. Divine Light truly makes a difference in children's lives.",
            author: "Pastor Emeka Okonkwo",
            role: "Parent, Seminary Student",
            rating: 5
        }
    ],

    // Color Palette
    colors: {
        primary: "#2563eb",
        primaryDark: "#1e40af",
        secondary: "#8b5cf6",
        accent: "#ec4899",
        success: "#10b981",
        warning: "#f59e0b",
        danger: "#ef4444",
        lightBg: "#f8fafc",
        darkBg: "#0f172a",
        textDark: "#1e293b",
        textLight: "#64748b"
    },

    // Navigation Links
    navLinks: [
        { name: "Home", href: "#home" },
        { name: "About", href: "#about" },
        { name: "Programs", href: "#programs" },
        { name: "Why Us", href: "#features" },
        { name: "Events", href: "#events" },
        { name: "Contact", href: "#contact" },
        { name: "Admission", href: "#admission", isButton: true }
    ],

    // Footer Links
    footerLinks: {
        quick: [
            { name: "About Us", href: "#about" },
            { name: "Programs", href: "#programs" },
            { name: "Events", href: "#events" },
            { name: "Contact", href: "#contact" }
        ],
        information: [
            { name: "Admissions", href: "#admission" },
            { name: "Prospectus", href: "#" },
            { name: "School Calendar", href: "#" },
            { name: "Staff Directory", href: "#" }
        ],
        legal: [
            { name: "Privacy Policy", href: "#" },
            { name: "Terms of Use", href: "#" },
            { name: "Disclaimer", href: "#" }
        ]
    },

    // Slider Settings
    slideshow: {
        autoRotate: true,
        rotationInterval: 5000, // milliseconds
        enableDots: true,
        enableArrows: true,
        slides: [
            {
                title: "Welcome to Divine Light",
                subtitle: "Where Excellence Meets Innovation in Education",
                image: "images/school_building.jpg",
                cta: "Enroll Now",
                ctaLink: "#admission"
            },
            {
                title: "Nurturing Young Minds",
                subtitle: "Building Future Leaders Through Quality Education",
                background: "linear-gradient(135deg, #667eea 0%, #764ba2 100%)",
                cta: "Learn More",
                ctaLink: "#about"
            },
            {
                title: "Academic Excellence",
                subtitle: "Combining Modern Teaching with Classical Values",
                background: "linear-gradient(135deg, #f093fb 0%, #f5576c 100%)",
                cta: "Discover Our Programs",
                ctaLink: "#programs"
            }
        ]
    },

    // SEO & Meta
    seo: {
        title: "Divine Light International School & Seminary - Excellence in Education",
        description: "Welcome to Divine Light International School & Seminary. We provide quality education combining classical values with modern teaching methodologies.",
        keywords: "school, education, academy, secondary school, seminary, excellence",
        author: "Divine Light School",
        ogImage: "images/school_building.jpg"
    },

    // Analytics
    analytics: {
        enabled: false,
        googleAnalyticsId: "YOUR_GA_ID_HERE"
    }
};

// Export for use in other scripts
if (typeof module !== 'undefined' && module.exports) {
    module.exports = schoolConfig;
}
