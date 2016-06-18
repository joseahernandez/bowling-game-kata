import Foundation

class BowlingGame {
    private static let FRAMES = 10
    private static let MAX_PINS_IN_ROLL = 10
    
    private var currentRoll: Int
    private var rolls: [Int]
    
    init() {
        currentRoll = 0
        rolls = [Int](count: 21, repeatedValue: 0)
    }
    
    func roll(pins: Int) {
        rolls[currentRoll] = pins
        currentRoll += 1
    }
    
    func score() -> Int {
        var score = 0
        var frame = 0
        for _ in 1...BowlingGame.FRAMES {
            
            switch frame {
                case let fr where isStrike(frame):
                    score += pointsInStrike(fr)
                    frame += 1
                case let fr where isSpare(frame):
                    score += pointsInSpare(fr)
                    frame += 2
                case let fr:
                    score += rolls[fr] + rolls[fr + 1]
                    frame += 2
            }
        }
        
        return score
    }
    
    private func isStrike(frame: Int) -> Bool {
        return rolls[frame] == BowlingGame.MAX_PINS_IN_ROLL
    }
    
    private func pointsInStrike(frame: Int) -> Int {
        return 10 + rolls[frame + 1] + rolls[frame + 2]
    }
    
    private func isSpare(frame: Int) -> Bool {
        return rolls[frame] + rolls[frame + 1] == BowlingGame.MAX_PINS_IN_ROLL
    }
    
    private func pointsInSpare(frame: Int) -> Int {
        return 10 + rolls[frame + 2]
    }
    
}