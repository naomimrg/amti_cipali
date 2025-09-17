import { motion } from "framer-motion";

export default function CreativeGridBackground({ images = [] }) {
    const [img1 = "", img2 = "", img3 = "", img4 = ""] = images;
    const transition = { duration: 0.9, ease: [0.22, 1, 0.36, 1] };

    return (
        <div className="bg-grid-wrapper">
            <motion.div initial={{ opacity: 0, x: -40, y: -40 }} animate={{ opacity: 1, x: 0, y: 0 }} transition={transition} whileHover={{ scale: 1.03 }} className="tile tl">
                <img src={img1} alt="bg-1" className="img" />
            </motion.div>

            <motion.div initial={{ opacity: 0, x: 40, y: -40 }} animate={{ opacity: 1, x: 0, y: 0 }} transition={{ ...transition, delay: 0.15 }} whileHover={{ scale: 1.03 }} className="tile tr">
                <img src={img2} alt="bg-2" className="img" />
            </motion.div>

            <motion.div initial={{ opacity: 0, x: -40, y: 40 }} animate={{ opacity: 1, x: 0, y: 0 }} transition={{ ...transition, delay: 0.3 }} whileHover={{ scale: 1.03 }} className="tile bl">
                <img src={img3} alt="bg-3" className="img" />
            </motion.div>

            <motion.div initial={{ opacity: 0, x: 40, y: 40 }} animate={{ opacity: 1, x: 0, y: 0 }} transition={{ ...transition, delay: 0.45 }} whileHover={{ scale: 1.03 }} className="tile br">
                <img src={img4} alt="bg-4" className="img" />
            </motion.div>

            <div className="overlay" />
        </div>
    );
}
